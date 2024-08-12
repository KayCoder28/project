import React from 'react';

function CommentItem({ comment, setParentCommentId }) {
    return (
        <li className="media" key={comment.id}>
            <a className="pull-left" href="#">
                <img className="media-object" src={comment.image_user} alt={comment.name_user} />
            </a>
            <div className="media-body">
                <ul className="single-post-meta">
                    <li><i className="fa fa-user" />{comment.name_user}</li>
                    <li><i className="fa fa-clock-o" /></li>
                    <li><i className="fa fa-calendar" /></li>
                </ul>
                <p>{comment.comment}</p>
                <a className="btn btn-primary" href="#" onClick={() => setParentCommentId(comment.id)}>
                    <i className="fa fa-reply" /> Reply
                </a>
                {comment.children && comment.children.length > 0 && (
                    <ul className="media-list">
                        {comment.children.map(childComment => (
                            <CommentItem key={childComment.id} comment={childComment} setParentCommentId={setParentCommentId} />
                        ))}
                    </ul>
                )}
            </div>
        </li>
    );
}

function ListComment({ comments, setParentCommentId }) {
    return (
        <div className="response-area">
            <h2>{comments.length} RESPONSES</h2>
            <ul className="media-list">
                {comments.map((comment) => (
                    <CommentItem key={comment.id} comment={comment} setParentCommentId={setParentCommentId} />
                ))}
            </ul>
        </div>
    );
}

export default ListComment;
