import { Component } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { AuthService } from '../_services/auth.service';

@Component({
  selector: 'app-recover',
  templateUrl: './recover.component.html',
  styleUrls: ['./recover.component.css'],
})
export class RecoverComponent {
  emailForm!: FormGroup;
  successMsg!: Object;
  errorMsg!: Object;
  constructor(private _auth: AuthService) {}

  onSubmit() {
    this._auth.sendResetPasswordEmail(this.emailForm.value).subscribe(
      (resp) => {
        this.successMsg = resp;
      },
      (error) => {
        this.errorMsg = error.error.message;
      }
    );
  }
}
