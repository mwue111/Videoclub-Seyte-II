import { Directive, EventEmitter, HostBinding, HostListener, Output } from '@angular/core';
import { FileHandle } from '../_model/file-handle.model';

@Directive({
  selector: '[appDrag]'
})
export class DragDirective {
  @HostBinding('style.background') private background = '#eee';
  @Output() files: EventEmitter<FileHandle> = new EventEmitter();


  constructor() { }

  @HostListener('dragover', ['$event'])
  public onDragOver(event: DragEvent){
    event.preventDefault();
    event.stopPropagation();

    this.background = '#999';
  }

  @HostListener('dragleave', ['$event'])
  public onDragLeave(event: DragEvent) {
    event.preventDefault();
    event.stopPropagation();

    this.background = '#eee'
  }

  @HostListener('drop', ['$event'])
  public onDrop(event: DragEvent) {
    event.preventDefault();
    event.stopPropagation();
    this.background = '#eee'

    let fileHandle: FileHandle;

    const image = event.dataTransfer?.files[0];

    fileHandle = {image};

    this.files.emit(fileHandle);
  }
}
