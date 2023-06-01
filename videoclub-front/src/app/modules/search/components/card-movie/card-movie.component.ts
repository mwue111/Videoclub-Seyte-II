import { Component, Input } from '@angular/core';
import { URL_BACKEND } from 'src/app/config/config';

@Component({
  selector: 'app-card-movie',
  templateUrl: './card-movie.component.html',
  styleUrls: ['./card-movie.component.css']
})
export class CardMovieComponent {
  @Input() movie: any;
  url: string = URL_BACKEND + '/storage/';

  ngOnInit(): void {
    // console.log('película en card-movie: ', this.movie);
  }

}
