import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { MoviesService } from '../services/movies.service';
import { AuthService } from '../modules/auth/_services/auth.service';
import { URL_BACKEND } from '../config/config';
import Swal from 'sweetalert2';
import { CommentsService } from '../modules/comments/_services/comments.service';
import { CommentInterface } from '../modules/comments/types/comment.interface';
import { UsersService } from '../services/users.service';

@Component({
  selector: 'app-movie',
  templateUrl: './movie.component.html',
  styleUrls: ['./movie.component.css']
})
export class MovieComponent {
  public movie: any;
  url: string = URL_BACKEND + '/storage/';
  logged: boolean;
  user: any;
  genreNames: any = [];
  source: string = '';

  constructor(
    private route: ActivatedRoute,
    private _movie: MoviesService,
    private _auth: AuthService,
    // private _comments: CommentsService,
    private router: Router,
    private _user: UsersService,
  ) {
    this.logged = this._auth.isLogged();
    this.user = this._auth.user.user;

    this.route.params.subscribe((params: any) => {
      console.log('params: ', params)
      let movieId = params.id;
      // let movieId = res.id;
      this._movie.getOneMovie(movieId, this._auth.token)
          .subscribe((res: any) => {
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

}
