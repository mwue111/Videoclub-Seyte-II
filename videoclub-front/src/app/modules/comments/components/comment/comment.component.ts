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

  username: string = '';
  usernames: any = [];
  displayComment: boolean = true;
  canEdit: boolean = true;
  canDelete: boolean = true;
  activeCommentType = ActiveCommentTypeEnum;

  constructor(
    private _comments: CommentsService,
    private route: ActivatedRoute,
    private _auth: AuthService,
  ) {}

  ngOnInit() {
      this.userData(this.comment.user_id);
  }

  userData(user: any){
    if(!isNaN(user)){
      this.usernames.push('Anónimo');
    }
    else{
      user.map((username: any) => {
        if(username.username){
          this.usernames.push(username.username);
        }
        else{
          this.usernames.push('Anónimo');
        }
        this.canEdit = this.commentOptions(null, username.id);
        this.canDelete = this.commentOptions('delete', username.id);
      })
    }
  }

  commentOptions(state:any = null, user: any){
    const fiveMinutes = 300000;
    let timePassed = new Date().getTime() - Date.parse(this.comment.created_at) > fiveMinutes;
    if(state === 'delete'){
      timePassed = false;
    }

    return Boolean(this._auth.isLogged()) && this._auth.user.id === user && !timePassed;
  }

  isEditing(): boolean {
    if(!this.activeComment){
      return false;
    }

    return this.activeComment.id === this.comment.id &&
            this.activeComment.type === this.activeCommentType.editing;
  }



}
