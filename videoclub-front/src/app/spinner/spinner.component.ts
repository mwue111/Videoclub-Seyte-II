import { Component, ViewEncapsulation } from '@angular/core';
import { LoaderService } from '../services/loader.service';

//Aquí: https://danielk.tech/home/angular-how-to-add-a-loading-spinner

@Component({
  selector: 'app-spinner',
  templateUrl: './spinner.component.html',
  styleUrls: ['./spinner.component.css'],
  encapsulation: ViewEncapsulation.ShadowDom
})
export class SpinnerComponent {
  constructor(public loader: LoaderService) { }
}
