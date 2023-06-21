import { Component } from '@angular/core';
import { MoviesService } from '../services/movies.service';
import { AuthService } from '../modules/auth/_services/auth.service';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';
import { URL_BACKEND } from '../config/config';

@Component({
  selector: 'app-view-movie',
  templateUrl: './view-movie.component.html',
  styleUrls: ['./view-movie.component.css']
})
export class ViewMovieComponent {
  movie: any;
  logged: boolean;
  url: string = URL_BACKEND + '/storage/';
  source: string = '';

  constructor(
    private _auth: AuthService,
    private _movie: MoviesService,
    private route: ActivatedRoute,
    private _location: Location
  ) {
    this.logged = this._auth.isLogged();

    this.route.params.subscribe((res: any) => {
      let movieId = res.id;
      this._movie.getOneMovie(movieId, this._auth.token)
          .subscribe((movie: any) => {
            this.movie = movie;
            this.source = this.url + this.movie.file;
          })
    })
  }

  goBack() {
    this._location.back();
  }

}
