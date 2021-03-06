import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { User } from '../_models/user';

@Injectable({ providedIn: 'root' })
export class UserService {
    constructor(private http: HttpClient) { }

    getAll() {
        return this.http.get<User[]>(`/api/users`);
    }

    getById(id: number) {
        return this.http.get(`/api/users/${id}`);
    }

    getCurrent() {
        return this.http.get<User>(`/api/user/current`);
    }

    register(user: User) {
        return this.http.post(`/api/auth/register`, user);
    }

    update(user: User) {
        return this.http.put(`/api/users/${user.id}`, user);
    }

    delete(id: number) {
        return this.http.delete(`/api/users/${id}`);
    }
}