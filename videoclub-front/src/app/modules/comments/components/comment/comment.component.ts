import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { CommentInterface } from '../../types/comment.interface';
import { CommentsService } from '../../_services/comments.service';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from 'src/app/modules/auth/_services/auth.service';
import { ActiveCommentInterface } from '../../types/activeComment.interface';
import { ActiveCommentTypeEnum } from '../../types/activeCommentType.enum';
import { URL_BACKEND } from 'src/app/config/config';

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

  user:any;
  url: string = URL_BACKEND + '/storage/';
  logged!:boolean;
  username: string = '';
  usernames: any = [];
  avatar: string = '';
  hasAvatar: boolean = true;
  displayComment: boolean = true;
  canEdit: boolean = true;
  canDelete: boolean = true;
  activeCommentType = ActiveCommentTypeEnum;

  constructor(
    private _comments: CommentsService,
    private route: ActivatedRoute,
    private _auth: AuthService,
  ) {
    if(this._auth.isLogged()){
      this.logged = true;
      this.user = this._auth.user.user;
    }
  }

  ngOnInit() {
    this.userData(this.comment.user_id);
  }

  userData(user: any){
    if(!isNaN(user)){
      this.usernames.push('Anónimo');
      this.canEdit = this.commentOptions(null, user);
      this.canDelete = this.commentOptions('delete', user);
    }
    else{
      user.map((username: any) => {
        if(username.username){
          this.usernames.push(username.username);
        }
        else{
          this.usernames.push('Anónimo');
        }

        if(username.image){
          this.avatar = username.image;
        }
        else{
          this.hasAvatar = false;
          this.avatar = 'https://i.pravatar.cc/100';
        }
        this.canEdit = this.commentOptions(null, username.id);
        this.canDelete = this.commentOptions('delete', username.id);
      })
    }
  }

  commentOptions(state:any, user: any){
    const fiveMinutes = 300000;
    let timePassed = new Date().getTime() - Date.parse(this.comment.created_at) > fiveMinutes;
    if(state === 'delete'){
      timePassed = false;
    }

    return Boolean(this._auth.isLogged()) && this._auth.user.user.id === user && !timePassed;
  }

  isEditing(): boolean {
    if(!this.activeComment){
      return false;
    }

    return this.activeComment.id === this.comment.id &&
            this.activeComment.type === this.activeCommentType.editing;
  }



}
