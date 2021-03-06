import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule }    from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS, HttpClientXsrfModule } from '@angular/common/http';
import { HttpClient } from '@angular/common/http';
import { CookieService } from 'ngx-cookie-service';

// used to create fake backend
import { fakeBackendProvider } from './_helpers/fake-backend';
import { first } from 'rxjs/operators';

import { AppComponent }  from './app.component';
import { routing }        from './app-routing.module';

import { AlertComponent } from './_components/alert.component';
import { JwtInterceptor } from './_helpers/jwt.interceptor';
import { ErrorInterceptor } from './_helpers/error.interceptor';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { UploadComponent } from './upload/upload.component';

import { DragDropDirective } from './_directives/drag-drop.directive';
import { UserService } from './_services/user.service';

import { Router } from '@angular/router';
import { AuthenticationService } from './_services/authentication.service';



@NgModule({
    imports: [
        BrowserModule,
        ReactiveFormsModule,
        HttpClientModule,
        HttpClientXsrfModule.withOptions({
            cookieName: 'XSRF-TOKEN',
            headerName: 'X-CSRF-TOKEN'
          }),
        routing
    ],
    declarations: [
        AppComponent,
        AlertComponent,
        HomeComponent,
        LoginComponent,
        RegisterComponent,
        UploadComponent,
        DragDropDirective
    ],
    providers: [
        { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
        { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
        CookieService

        // provider used to create fake backend
        //fakeBackendProvider
    ],
    bootstrap: [AppComponent]
})

export class AppModule { 
    constructor(private http: HttpClient, private cookie: CookieService, 
        private userService: UserService, private router: Router,
        private authenticationService: AuthenticationService) {
        this.setCsrf ();

        // Sprawdzenie czy jestem zalogowany po stronie serwera
        this.userService.getCurrent().pipe(first()).subscribe(user => {
            console.log(user);
        },
        error => {
            this.authenticationService.logout();
            this.router.navigate(['/login']);
        });
    }

    setCsrf() {
        this.http.get('/api/auth/csrf')
        .subscribe(res => {
            this.cookie.set('XSRF-TOKEN', res['csrf']);
        });
    }
}