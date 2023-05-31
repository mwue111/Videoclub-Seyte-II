import { Component } from '@angular/core';
import { SearchService } from '../../_services/search.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {

  constructor(
    private _movies: SearchService,
  ) {

    this._movies.search('Avatar')
        .subscribe((res: any) => {
          console.log('res: ', res);
        })
  }

}
