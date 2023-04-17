import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';
import { ActivatedRoute } from '@angular/router';
import { throwError } from 'rxjs';

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})
export class ChangePasswordComponent implements OnInit{
  changePasswordForm: FormGroup;
  errors: any;
  constructor(private fb: FormBuilder, private _auth: AuthService, private route: ActivatedRoute) {
    this.changePasswordForm = this.fb.group({
      email: [''],
      password: [''],
      password_confirmation: [''],
      passwordToken: ['']
    });
    route.queryParams.subscribe(params => {
      this.changePasswordForm.controls['passwordToken'].setValue(params['token']);
    });
  }

  ngOnInit(): void {
    this.initForm();
  }
  
initForm() {
    this.changePasswordForm = this.fb.group({
      email: [
        null,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250)
        ])
      ],
      password: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ],
      password_confirmation: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ]
    })
  }

  onSubmit() {
    this._auth.resetPassword(this.changePasswordForm.value).subscribe(
      (result) => {
        alert('Contraseña cambiada correctamente');
        this.changePasswordForm.reset();
      },
      (error) => {
        this.handleError(error);
      }
    );
  }

  handleError(error: any) {
    let errorMsg = '';
    if (error.error instanceof ErrorEvent) {
      errorMsg = `Error: ${error.error.message}`;
    } else {
      errorMsg = `Error Code: ${error.status},  Message: ${error.message}`;
    }
    console.log(errorMsg);
    return throwError(() => {
      errorMsg;
    });
  }
}
