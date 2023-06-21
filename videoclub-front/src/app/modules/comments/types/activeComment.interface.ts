import { ActiveCommentTypeEnum } from "./activeCommentType.enum";

export interface ActiveCommentInterface {
  id: number | string;
  type: ActiveCommentTypeEnum
}
