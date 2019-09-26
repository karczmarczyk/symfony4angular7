import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-upload',
  templateUrl: './upload.component.html',
  styleUrls: ['./upload.component.scss']
})
export class UploadComponent implements OnInit {

  files: any = [];
  preview: any = [];

  constructor(private http: HttpClient) { }

  ngOnInit() {
  }

  uploadFile(event) {
    for (let index = 0; index < event.length; index++) {
      const element = event[index];

      const reader = new FileReader();
      reader.readAsDataURL(element);
      reader.onload = (_event) => {

        this.files.push(element);
        console.log(element);

        this.preview.push({
          imgURL: reader.result,
          name: element.name
        });
      };
    }
  }

  deleteAttachment(index) {
    this.files.splice(index, 1);
    this.preview.splice(index, 1);
  }

  sendImages() {
    console.log(this.files);
    for (let i=0; i<this.files.length; i++) {
      let image = this.files[i];
      const formData: FormData = new FormData();
      formData.append('file', image, image.name);
      formData.append('id', '100');
      this.http.post('/api/upload', formData)
      .subscribe(res => {
        console.log(res);
        alert('SUCCESS !!');
      });
    }
  }
}
