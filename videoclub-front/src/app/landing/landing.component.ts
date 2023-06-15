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
  dramaMovies: any = [];
  comedyMovies: any = [];
  url: string = URL_BACKEND + '/storage/';

  constructor(
    private _movies: MoviesService,
    private _genres: GenresService,
    private _authServices: AuthService
  ) {}

  ngOnInit(): void {
    this.getLatestMovies();
    this.getGenres();
    this.getMovies();
    // this.getGenresMovies();
  }

  getLatestMovies() {
    // this._movies.getMovies(2, this._authServices.token).subscribe((res) => {
    this._movies.getMovies(2, this._authServices.token).subscribe((res) => {
      this.movies = res;
      // console.log('movies: ', this.movies);
    });
  }

  getGenres() {
    this._genres.getGenres(4, this._authServices.token).subscribe((res) => {
      this.genres = res;
    });
  }

  getMovies() {
    this._movies.getAllMovies().subscribe((res: any) => {
      res.forEach((element:any) => {
        for(let i = 0; i < element.genres.length; i++){
          switch(element.genres[i].id){
            case 1: this.actionMovies.push(element); break;
            case 2: this.adventureMovies.push(element); break;
            case 3: this.comedyMovies.push(element); break;
            case 4: this.dramaMovies.push(element); break;
          }
        }
      });
    })
  }

  // getGenresMovies() {
  //   this._genres
  //     .getMoviesGenre(100, 1)
  //     .subscribe((res) => {
  //       this.actionMovies = res;
  //     });
  //   this._genres
  //     .getMoviesGenre(100, 2)
  //     .subscribe((res) => {
  //       this.adventureMovies = res;
  //     });
  //   this._genres
  //     .getMoviesGenre(100, 3)
  //     .subscribe((res) => {
  //       this.comedyMovies = res;
  //     });
  //   this._genres
  //     .getMoviesGenre(100, 4)
  //     .subscribe((res) => {
  //       this.dramaMovies = res;
  //     });
  // }
}
