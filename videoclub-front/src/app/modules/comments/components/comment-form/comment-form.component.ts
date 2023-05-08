import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'comment-form',
  templateUrl: './comment-form.component.html',
  styleUrls: ['./comment-form.component.css'],
})
export class CommentFormComponent implements OnInit{
  @Input() submitLabel!: string;
  @Input() hasCancelButton: boolean = false;
  @Input() initialText: string = '';
  @Output() handleSubmit = new EventEmitter<any>();
  form!: FormGroup;

  constructor(
    private fb: FormBuilder,
  ) {}

  ngOnInit(): void {
    this.form = this.fb.group({
      title: [this.initialText, Validators.required],
      description: [this.initialText, Validators.required]
    });
  }

  //Aquí: https://www.youtube.com/watch?v=_DACuv_xYCs&ab_channel=MonsterlessonsAcademy

  onSubmit() {
    this.handleSubmit.emit(this.form.value);
  }
}
