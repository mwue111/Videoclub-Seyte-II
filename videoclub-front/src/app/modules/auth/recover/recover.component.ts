import { Component } from '@angular/core';
import { FormGroup } from '@angular/forms';

@Component({
  selector: 'app-recover',
  templateUrl: './recover.component.html',
  styleUrls: ['./recover.component.css'],
})
export class RecoverComponent {
  emailForm!: FormGroup;
  constructor() {}

  submit() {
    console.log('valores: ');
  }
}
