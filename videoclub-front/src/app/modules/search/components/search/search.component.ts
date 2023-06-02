import { Component } from '@angular/core';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, tap, filter } from 'rxjs';
import { NavigationExtras, Router } from '@angular/router';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {
  submitted: any = '';
  results: any;
  inputSearch = new FormControl('');

  constructor(
    private router: Router,
  ) {}

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

  //Aquí: https://medium.com/@iborn2code/angular-using-query-parameters-with-routing-59494396703e
  onSearch(): void {
    const queryParams: NavigationExtras = {
      queryParams: { search: this.submitted },
      queryParamsHandling: 'preserve'
    };

    this.router.navigate(['/results'], queryParams);
    // this.router.navigate(['/results'], {queryParams: {search: this.submitted}});

  }
}
