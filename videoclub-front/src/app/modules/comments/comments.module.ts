import { NgModule } from "@angular/core";
import { CommentsComponent } from "./components/comments/comments.component";
import { CommentsService } from "./_services/comments.service";
import { CommonModule } from "@angular/common";
import { CommentComponent } from "./components/comment/comment.component";
import { CommentFormComponent } from './components/comment-form/comment-form.component';
import { ReactiveFormsModule } from "@angular/forms";
import { RouterModule } from "@angular/router";

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RouterModule
  ],
  declarations: [
    CommentsComponent,
    CommentComponent,
    CommentFormComponent,
  ],
  exports: [
    CommentsComponent,
  ],
  providers: [
    CommentsService,
  ]
})
export class CommentsModule {}
