import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { MoviesService } from '../services/movies.service';
import { AuthService } from '../modules/auth/_services/auth.service';
import { URL_BACKEND } from '../config/config';

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

  constructor(
    private route: ActivatedRoute,
    private _movie: MoviesService,
    private _auth: AuthService,
  ) {
    this.logged = this._auth.isLogged();
    this.user = this._auth.user;

    this.route.params.subscribe((res: any) => {
      //Aquí: mandar un número, no un objeto
      //https://www.youtube.com/watch?v=jMNUpe62WnI&ab_channel=ProgramadorNovato
      let movieId = res.id;
      this._movie.getOneMovie(movieId, this._auth.token)
          .subscribe((res: any) => {
            this.movie = res;
          });

      this._movie.getMovieGenre(movieId)
          .subscribe((res: any) => {
            for(let i = 0; i < res.length; i++){
              this.genreNames.push(res[i].name)
            }
            // console.log('res: ', res);
            // console.log('genreNames: ', this.genreNames);
          })
    })

  }


}
