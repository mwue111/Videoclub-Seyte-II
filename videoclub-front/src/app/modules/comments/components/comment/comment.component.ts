import { Component, Input } from '@angular/core';
import { CommentInterface } from '../../types/comment.interface';
import { CommentsService } from '../../_services/comments.service';

@Component({
  selector: 'comment',
  templateUrl: './comment.component.html',
  styleUrls: ['./comment.component.css']
})
export class CommentComponent {
  @Input() comment!: CommentInterface;
  user: any = '';

  //Aquí: https://www.youtube.com/watch?v=_DACuv_xYCs&ab_channel=MonsterlessonsAcademy

  constructor(
    private _comments: CommentsService,
  ) {
    //Obtener los datos de cada autor de cada reseña:
    // this._comments.getAuthors(21)
    //     .subscribe((res: any) => {
    //       console.log('reseñas: ', res);
    //     })
  }

}
