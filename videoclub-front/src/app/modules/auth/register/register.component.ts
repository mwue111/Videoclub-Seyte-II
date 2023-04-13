import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit{
  loginForm!: FormGroup;
  hasError: Boolean = false;
  hasErrorText: any = '';
  hasSuccess: Boolean = true;
  hasSuccessText: any = '';

  constructor(
    private fb: FormBuilder,
    private authServices: AuthService,
    private route: Router,
    private router: ActivatedRoute,
  ){
    if(this.authServices.isLogged()){
      this.route.navigate(['/']);
    }
  }

  ngOnInit(): void {
    this.initForm();
    console.log('¿Hay errores? ', this.hasError);
  }

  initForm() {
    this.loginForm = this.fb.group({
      email: [
        null,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250)
        ])
      ],
      c_email: [
        null,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250)
        ])
      ],
      birth_date: [
        null,
        Validators.compose([
          Validators.required,
          Validators.pattern(/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/)
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
      c_password: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ]
    })
  }

  verifyEmail(email: string, c_email: string) {
    return email !== c_email;
  }

  verifyPassword(password: string, c_password: string) {
    return password !== c_password;
  }

  submit() {
    this.hasError = false;
    this.hasErrorText = '';

    if(this.verifyPassword(this.loginForm.value.password, this.loginForm.value.c_password)){
      this.hasError = true;
      this.hasErrorText = 'Las contraseñas no coinciden.';
    }

    if(this.verifyEmail(this.loginForm.value.email, this.loginForm.value.c_email)){
      this.hasError = true;
      this.hasErrorText = 'Los emails no coinciden. ';
    }

    if(this.hasError == false){
      this.authServices.register(this.loginForm.value)
                        .subscribe((res: any) => {
                          console.log('respuesta en submit al registrarse: ', res);
                          if(!res.error && res){
                            this.hasSuccess = true;
                            this.hasSuccessText = 'El registro se ha realizado con éxito.';
                            setTimeout(() => {
                              this.route.navigate(['auth/login']);
                            }, 2000);
                          }
                        },
                        error => {
                          console.log(error);
                          if(error.error.message.includes('Integrity constraint violation')) {
                            this.hasError = true;
                            this.hasErrorText += 'El usuario con email ' + this.loginForm.value.email + ' ya existe. ';
                          }
                        })
    }
  }

}
