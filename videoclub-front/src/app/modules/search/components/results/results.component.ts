import { Component } from '@angular/core';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { SearchService } from '../../_services/search.service';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent {
  query: any;
  results: any = [];

  constructor(
    private route: ActivatedRoute,
    private _search : SearchService,
  ) {
    this.query = this.route.snapshot.queryParamMap.get('search');
    console.log('query: ', this.query);
  }

  ngOnInit(): void {
    this._search.search(this.query)
        .subscribe((res: any) => {
          for(let i = 0; i < res.length; i++){
            this.results.push(res[i]);
          }
        })
        console.log('resultado de la búsqueda fuera de la suscripción: ', this.results)
  }

}
