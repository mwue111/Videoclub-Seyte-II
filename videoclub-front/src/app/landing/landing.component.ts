import { Component, OnInit } from '@angular/core';
import { MoviesService } from '../services/movies.service';
import { GenresService } from '../services/genres.service';
import { URL_BACKEND } from '../config/config';
import { AuthService } from '../modules/auth/_services/auth.service';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css'],
})
export class LandingComponent implements OnInit {
  movies: any = [];
  genres: any = [];
  actionMovies: any = [];
  adventureMovies: any = [];
  animationMovies: any = [];
  comedyMovies: any = [];
  url: string = URL_BACKEND + '/storage/';

  constructor(
    private _movies: MoviesService,
    private _genres: GenresService,
    private _authServices: AuthService,
    ) {}

  ngOnInit(): void {
    this.getLatestMovies();
    this.getGenres();
    this.getGenresMovies();
  }

  getLatestMovies() {
    this._movies.getMovies(2, this._authServices.token).subscribe((res) => {
      this.movies = res;
      console.log('movies: ', this.movies);
    });
  }

  getGenres() {
    this._genres.getGenres(4, this._authServices.token).subscribe((res) => {
      console.log(res);
      this.genres = res;
      console.log('genres: ', this.genres);
    });
  }

  getGenresMovies() {
    console.log(this.genres.length);
    this._genres.getMoviesGenre(10, 1, this._authServices.token).subscribe((res) => {
      this.actionMovies = res;
    });
    this._genres.getMoviesGenre(10, 2, this._authServices.token).subscribe((res) => {
      this.adventureMovies = res;
    });
    this._genres.getMoviesGenre(10, 3, this._authServices.token).subscribe((res) => {
      this.animationMovies = res;
    });
    this._genres.getMoviesGenre(10, 4, this._authServices.token).subscribe((res) => {
      this.comedyMovies = res;
    });
  }
}
