import { Component, OnInit } from '@angular/core';
import { MoviesService } from '../services/movies.service';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent implements OnInit{
  movies: any = [];

  constructor(
    private _http: MoviesService
  ){}

  ngOnInit() :void {
    this.getMovies();
  }

  getMovies() {
    // this._movieService.getMovies(2).subscribe(res => {
    //   console.log(res)}
    //   );
    this._http.getMovies(2)
              .subscribe(res => {
                console.log(res);
              })
  }

}
