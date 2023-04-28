import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { MoviesService } from '../services/movies.service';
import { AuthService } from '../modules/auth/_services/auth.service';

@Component({
  selector: 'app-movie',
  templateUrl: './movie.component.html',
  styleUrls: ['./movie.component.css']
})
export class MovieComponent {

  constructor(
    private route: ActivatedRoute,
    private _movie: MoviesService,
    private _auth: AuthService,
  ) {
    this.route.params.subscribe((res: any) => {
      //Aquí: mandar un número, no un objeto
      //https://www.youtube.com/watch?v=jMNUpe62WnI&ab_channel=ProgramadorNovato
      console.log(res);
      console.log(this._movie.getOneMovie(res, this._auth.token));
    })
  }

}
