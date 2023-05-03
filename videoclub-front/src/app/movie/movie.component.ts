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

  constructor(
    private route: ActivatedRoute,
    private _movie: MoviesService,
    private _auth: AuthService,
  ) {
    this.route.params.subscribe((res: any) => {
      //Aquí: mandar un número, no un objeto
      //https://www.youtube.com/watch?v=jMNUpe62WnI&ab_channel=ProgramadorNovato
      let movieId = res.id;
      this._movie.getOneMovie(movieId, this._auth.token)
          .subscribe((res: any) => {
            this.movie = res;
            console.log(this.movie);
          });
    })
  }

}
