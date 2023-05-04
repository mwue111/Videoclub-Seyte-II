import { NgModule } from "@angular/core";
import { CommentsComponent } from "./components/comments/comments.component";
import { CommentsService } from "./_services/comments.service";
import { CommonModule } from "@angular/common";
import { CommentComponent } from "./components/comment/comment.component";

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [
    CommentsComponent,
    CommentComponent,
  ],
  exports: [
    CommentsComponent,
  ],
  providers: [
    CommentsService,
  ]
})
export class CommentsModule {}
