import { Component, OnInit } from '@angular/core';
import { MoviesService } from '../services/movies.service';
import { GenresService } from '../services/genres.service';
import { URL_BACKEND } from '../config/config';

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

  constructor(private _movies: MoviesService, private _genres: GenresService) {}

  ngOnInit(): void {
    this.getLatestMovies();
    this.getGenres();
    this.getGenresMovies();
  }

  getLatestMovies() {
    this._movies.getMovies(2).subscribe((res) => {
      console.log(res);
      this.movies = res;
      console.log('movies: ', this.movies);
    });
  }

  getGenres() {
    this._genres.getGenres(4).subscribe((res) => {
      console.log(res);
      this.genres = res;
      console.log('genres: ', this.genres);
    });
  }

  getGenresMovies() {
    console.log(this.genres.length);
    this._genres.getMoviesGenre(10, 1).subscribe((res) => {
      this.actionMovies = res;
      console.log('actionMovies: ', this.actionMovies);
    });
    this._genres.getMoviesGenre(10, 2).subscribe((res) => {
      this.animationMovies = res;
      console.log('genresMovies: ', this.animationMovies);
    });
    this._genres.getMoviesGenre(10, 3).subscribe((res) => {
      this.adventureMovies = res;
      console.log('genresMovies: ', this.adventureMovies);
    });
    this._genres.getMoviesGenre(10, 4).subscribe((res) => {
      this.comedyMovies = res;
      console.log('genresMovies: ', this.comedyMovies);
    });
  }
}
