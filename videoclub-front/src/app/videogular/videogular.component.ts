import { Component, Input } from '@angular/core';

@Component({
  selector: 'videogular',
  templateUrl: './videogular.component.html',
  styleUrls: ['./videogular.component.css']
})
export class VideogularComponent {
  @Input() source!: string;

}
