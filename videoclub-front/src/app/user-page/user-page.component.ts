import { Component, OnInit } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from '../services/users.service';
import { Observable, map, of, switchMap } from 'rxjs';
import Swal from 'sweetalert2';
import { UserSharedServiceService } from '../services/user-shared-service.service';
import { URL_BACKEND } from '../config/config';
import { FileHandle } from '../_model/file-handle.model';
import { CommentsService } from '../modules/comments/_services/comments.service';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent implements OnInit{
  user: any;
  url: string = URL_BACKEND + '/storage/';
  updatingImage!: boolean;
  userImage: any;
  isEditing!: boolean;
  editForm!: FormGroup;
  hasError: boolean = false;
  hasErrorText: string = '';
  hasImageError: boolean = false;
  hasImageErrorText: string = '';
  movies: any = [];
  watchedMovies!: boolean;
  reviews: any = [];
  activeMovies: any = [];
  //paginación
  data: any;
  currentPage!: number;
  pageChange: any = null;
  imagePreview: any;

  constructor(
    private _auth: AuthService,
    private router: Router,
    private _users: UsersService,
    private fb: FormBuilder,
    private _shared: UserSharedServiceService,
  ) {}

  fetchUser(): Promise<any> {
    return new Promise<void>((resolve, reject) => {
      this._users.getUser(this._auth.token, this.user.id)
              .subscribe((res: any) => {
                this.user = res;
                resolve();
              },
              (error: any) => {
                reject(error);
              }
              );
    });
  }

  async ngOnInit() {
    this.currentPage = 1;

    if(this._auth.isLogged()){
      this.user = this._auth.user.user;
      if(this.user.role === 'free'){
        this.checkRentedMovies();
      }
      this.watchedMovies = true;
      this.getViews();
      this.getReviews(this.currentPage);
      console.log(this.reviews);
    }
    else{
      this.router.navigate(['auth/login']);
    }

    this._shared.username$.subscribe(username => {
      this.user.username = username
    })
    await this.fetchUser();
    this.initializeForm();
  }

  checkRentedMovies() {
    console.log('chequeando alquileres');
    this._users.checkRents(this._auth.token).subscribe((res: any) => {
      console.log('res: ', res);
    })
  }

  getViews(){
    if(this.user.role === 'premium'){
      this._users.getViews(this._auth.token)
                .subscribe((res: any) => {
                  if(res.length){
                    for(let i = 0; i < res.length; i++){
                      this.movies.push(res[i]);
                    }
                  }
                  else{
                    this.watchedMovies = false;
                  }
                })
    }
    else{
      this._users.getRents(this._auth.token).subscribe((res: any) => {
        if(res.length) {
          for(let i = 0; i < res.length; i++) {
            if(res[i].pivot.deleted_at === null){
              this.activeMovies.push(res[i]);
            }
            else{
              this.movies.push(res[i]);
            }
          }
        }
        else{
          this.watchedMovies = false;
        }
      })
    }
  }

  //let days = new Date().getDay() - new Date("2013-02-20T12:01:04.753Z").getDay();

  getReviews(page: number){
    this._users.getReviews(this._auth.token, this.user.id, page)
              .subscribe((res: any) => {
                if(res.data){
                  this.data = res;
                  this.currentPage = res.current_page;
                  this.reviews = res.data;
                }
                else{
                  this.reviews = [];
                }
              })
  }


  initializeForm() {
    this.editForm = this.fb.group({
      username: [
        this.user.username,
        Validators.compose([
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      name: [
        this.user.name,
        Validators.compose([
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      surname: [
        this.user.surname,
        Validators.compose([
          Validators.minLength(2),
          Validators.maxLength(20)
        ])
      ],
      email: [
        this.user.email,
        Validators.compose([
          Validators.required,
          Validators.email,
          Validators.minLength(3),
          Validators.maxLength(250)
        ])
      ],
      birth_date: [
        this.user.birth_date,
        Validators.compose([
          Validators.required,
          Validators.pattern(/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/)
        ])
      ],
      image: [
        null,
      ],
      password: [
        null,
        Validators.compose([
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ],
      new_pass: [
        null,
        Validators.compose([
          Validators.minLength(8),
          Validators.maxLength(100)
        ])
      ],
    })
  }

  verifyPassword(email:string, password: string): Observable<boolean>{
    return this._auth.verifyOldPass(email, password).pipe(
      map((res: any) => {
        return res === 1;
      })
    )
  }

  updateUser(){
    this.isEditing = true;
    this.hasError = false;
    this.initializeForm();
  }

  saveChanges(){
    this.verifyPassword(this.user.email, this.editForm.value.password).pipe(
          switchMap((passMatches: boolean) => {
            if(!passMatches) {
              return of(null);
            }
            else{
              if(this.editForm.value.new_pass){
                const data = {
                  'email': this.user.email,
                  'password': this.editForm.value.new_pass
                };

                this._users.resetPassword(this._auth.token, data)
                            .subscribe((res: any) => {
                              console.log('respuesta recibida en contraseña: ', res);
                            })
                }

              if(this.editForm.value.image || this.userImage !== undefined){
                console.log('hay imagen');
                this.editForm.value.image = this.userImage;

                this._users.editUserImage(this._auth.token, this.user.id, this.editForm.value.image)
                            .subscribe((res: any) => {
                              // console.log('res con imagen: ', res)
                              if(res){
                                if(res.error){
                                  this.editForm.controls['password'].reset();
                                }
                              }
                            })
                }
                return this._users.editUser(this._auth.token, this.user.id, this.editForm.value);
            }
          })
        )
        .subscribe((res: any) => {
          console.log('res sin imagen: ', res);
          if(res){
            if(res.error){
              this.editForm.controls['password'].reset();
              this.hasError = true;
              if(res.error.errors.username){
                this.hasErrorText = 'Este nombre de usuario ya está en uso.';
              }
              if(res.error.errors.image){
                this.hasErrorText = 'Ha habido problemas subiendo la imagen.';
              }
            }
            else{
              this.user = res;
              this.close();
              this.fetchUser();
              this._shared.updateUsername(res.username);
              this._shared.updateImage(res.image);
              this.userImage = undefined;
              this.updatingImage = false;


              Swal.fire({
                icon: 'success',
                title: '¡Tus datos se han actualizado!',
                confirmButtonColor: '#1874BA'
              })
            }
          }
          else{
            this.editForm.controls['password'].reset();
            this.hasError = true;
            this.hasErrorText = 'La contraseña no es correcta.';
          }
        })
  }

  close(){
    this.isEditing = false;
    this.updatingImage = false;
  }

  onFileSelected(event: any) {
    if(event.target.files) {
      this.updatingImage  = true;
      const file = event.target.files[0];

      this.previewImage(file);

      const fileHandle: FileHandle = {
        image: file,
      }

      this.userImage = fileHandle;
    }

  }

  fileDropped(fileHandle: FileHandle) {
    this.updatingImage  = true;
    const file = fileHandle;

    this.previewImage(file.image);

    this.userImage = fileHandle;
  }

  //Para previsualizar la imagen antes de subirla:
  previewImage(file: any) {
    this.hasImageError = false;

    const reader = new FileReader();

    reader.onload = () => {
      this.imagePreview = reader.result as string;

      //Comprueba que sea una imagen:
      if(!this.imagePreview.includes('image')){
        this.hasImageError = true;
        this.hasImageErrorText = 'Formato de imagen incorrecto, haz click para subir otra imagen.';
      }
    }
    return reader.readAsDataURL(file)
  }

  changePage(page: number | null){
    if(page !== null){
      this.currentPage = page;
      this.getReviews(this.currentPage);
    }
  }
}
