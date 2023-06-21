import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { MoviesService } from '../services/movies.service';
import { AuthService } from '../modules/auth/_services/auth.service';
import { URL_BACKEND } from '../config/config';
import Swal from 'sweetalert2';
import { UsersService } from '../services/users.service';
import { MatDialog } from '@angular/material/dialog';
import { PopupComponent } from '../modals/popup/popup.component';

@Component({
  selector: 'app-movie',
  templateUrl: './movie.component.html',
  styleUrls: ['./movie.component.css']
})
export class MovieComponent {
  public movie: any;
  url: string = URL_BACKEND + '/storage/';
  logged!: boolean;
  user: any;
  token: any;
  genreNames: any = [];
  source: string = '';
  activeRent: boolean = false;

  constructor(
    private route: ActivatedRoute,
    private _movie: MoviesService,
    private _auth: AuthService,
    private router: Router,
    private _user: UsersService,
    public dialog: MatDialog,
  ) {}

  ngOnInit(): void {
    this.logged = this._auth.isLogged();
    if(this._auth.user){
      this.user = this._auth.user.user;
      this.token = this._auth.token;
    }
    else{
      this.token = 'none';
    }

    this.route.params.subscribe((params: any) => {
      let movieId = params.id;

      this._movie.getOneMovie(movieId, this.token)
          .subscribe((res: any) => {
            console.log('res: ', res);
            this.movie = res;
            this.source = this.url + this.movie.trailer;
          });

      this._movie.getMovieGenre(movieId)
          .subscribe((res: any) => {
            for(let i = 0; i < res.length; i++){
              this.genreNames.push(res[i].name)
            }
          })
    })

    if(this.user && this.user.role === 'free'){
      this._user.checkRents(this._auth.token).subscribe((res: any) => {
        res.forEach((element: any) => {
            if(element.id === this.movie.id) {
              this.activeRent = true;
            }
        });
      })
    }
  }

  unloggedHandle() {
    Swal.fire({
      icon:'info',
      title:'¡Necesitas iniciar sesión para ver esta película!',
      text: 'Sólo te llevará un minuto y podrás ver esta película y muchas otras cuando quieras.',
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: true,
      confirmButtonText: 'Iniciar sesión',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#159CA3'
    }).then(res => {
      if(res.isConfirmed){
        this.router.navigate(['auth/login'])
      }
    })
  }

  addToViews(id: number) {
    console.log('Añadir película con id ', id);
    this._user.createView(this._auth.token, this.user.id, id).subscribe((res: any) => {
      console.log('res: ', res);
    })
  }

  openDialog() {
    this.dialog.open(PopupComponent, {
      width: '20%',
      data: {
        movie: {
          id: this.movie.id,
          title: this.movie.title,
          price: this.movie.price,
        },
        user: {
          id: this.user.id,
          username: this.user.username
        }
      }
    })
  }
}
