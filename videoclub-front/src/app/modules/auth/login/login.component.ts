import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit{
  loginForm!: FormGroup;
  hasError: Boolean = false;
  hasErrorText: any = '';

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
  }

  initForm() {
    this.loginForm = this.fb.group({
      email: [
        null,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250),
        ])
      ],
      password: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100),
        ])
      ],
      remember_me: [
        null,
      ]
    })
  }

  submit() {
    this.hasError = false;
    console.log('valores: ', this.loginForm.value);

    this.authServices.login(this.loginForm.value.email, this.loginForm.value.password, this.loginForm.value.remember_me)
                      .subscribe((res: any) => {
                        console.log('respuesta en la función submit() de login.component.ts: ', res);
                        if(!res.error && res){
                          document.location.reload();
                        }
                        else{
                          console.log('res en error: ', res.error.data.error);
                          if(res.error.data.error == 'Unauthorized') {
                            this.hasError = true;
                            this.hasErrorText = 'El usuario con email ' + this.loginForm.value.email + ' no existe o la contraseña es incorrecta.';
                          }
                        }
                      },
                      error => {
                        console.log('Ha ocurrido un error intentando iniciar sesión: ', error);
                      })
  }

}
