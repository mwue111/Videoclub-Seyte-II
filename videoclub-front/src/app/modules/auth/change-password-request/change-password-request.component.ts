import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';

@Component({
  selector: 'app-change-password-request',
  templateUrl: './change-password-request.component.html',
  styleUrls: ['./change-password-request.component.css']
})
export class ChangePasswordRequestComponent {
  resetForm: FormGroup;
  errors: any;
  successMsg: any;
  
  constructor(private fb: FormBuilder, private _auth: AuthService) {
    this.resetForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
    });
  }

  onSubmit() {
    this._auth.sendResetPasswordEmail(this.resetForm.value).subscribe(
      (resp:any) => {
        this.successMsg = resp;
        alert(this.successMsg.message)
      },
      (error) => {
        this.errors = error.error.message;
      }
    );
  }
}
