import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { CommentInterface } from '../../types/comment.interface';
import { CommentsService } from '../../_services/comments.service';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { ActiveCommentInterface } from '../../types/activeComment.interface';
import { ActiveCommentTypeEnum } from '../../types/activeCommentType.enum';

@Component({
  selector: 'comment',
  templateUrl: './comment.component.html',
  styleUrls: ['./comment.component.css']
})
export class CommentComponent implements OnInit {
  @Input() comment!: CommentInterface;
  @Input() activeComment!: ActiveCommentInterface | null;
  @Output() setActiveComment = new EventEmitter<ActiveCommentInterface | null>();
  @Output() updateComment = new EventEmitter<{
    body: string;
    commentId: string | number;
  }>();
  @Output() deleteComment = new EventEmitter<string|number>();
  //aquí: https://www.youtube.com/watch?v=_DACuv_xYCs&ab_channel=MonsterlessonsAcademy

  username: string = '';
  displayComment: boolean = true;
  canEdit: boolean = true;
  canDelete: boolean = true;
  activeCommentType = ActiveCommentTypeEnum;

  constructor(
    private _comments: CommentsService,
    private route: ActivatedRoute,
    private _auth: AuthService,
  ) {
    this.route.paramMap.subscribe(params => {
      const movieId = params.get('id');
      if(movieId){
        this._comments.getAuthors(movieId)
            .subscribe((res: any) => {
              // if(res !== 'none' && Number(movieId) === this.comment.movie_id) {
                const user = res.find((user: any) => user.id === this.comment.user_id);
                if(user){
                  this.username = user.username;
                }
              // }
              // else{
              //   this.displayComment = false;
              // }
        });
      }
    });
  }

  ngOnInit() {
      const fiveMinutes = 300000;
      const timePassed = new Date().getTime() - Date.parse(this.comment.created_at) > fiveMinutes;

      this.canEdit = Boolean(this._auth.isLogged()) && this._auth.user.id === this.comment.user_id; // && !timePassed;
      this.canDelete = Boolean(this._auth.isLogged()) && this._auth.user.id === this.comment.user_id;
  }

  isEditing(): boolean {
    if(!this.activeComment){
      return false;
    }

    return this.activeComment.id === this.comment.id &&
            this.activeComment.type === this.activeCommentType.editing;
  }



}
