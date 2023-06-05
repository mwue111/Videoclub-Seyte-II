import { Component, Input } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { Router } from '@angular/router';
import { SearchSharedServiceService } from 'src/app/services/search-shared-service.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {
  submitted: any = '';
  results: any;
  inputSearch = new FormControl('');
  value: string = '';

  constructor(
    private router: Router,
    private _shared: SearchSharedServiceService,
  ) {}

  ngOnInit() {
    this._shared.query$.subscribe(receivedQuery =>
      this.value = receivedQuery
    )
  }

  onChange(): void {
    this.inputSearch.valueChanges.pipe(
      debounceTime(350),                      //espera 350ms para enviar la petición
      distinctUntilChanged(),                 //verifica que el valor a emitir no es igual al ya emitido
      filter((search:any) => search !== ''),  //se asegura que no llegue un string vacío
      tap((res: any) => {
        this.submitted = res;
      })
    ).subscribe();
  }

  onSearch(): void {
    this.router.navigate(['/results'], {queryParams: {search: this.submitted}});
  }
}
