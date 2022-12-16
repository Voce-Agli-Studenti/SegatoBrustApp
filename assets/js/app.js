function castFeedbackVote(feedback_id, vote) {
	var data = {
		feedback_id: feedback_id,
		vote: vote,
	};

	fetch('/api/cast_feedback_vote', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	}).then((response) => response.json())
		.then((data) => {
			if (data.ok) {
				switch (data.result.feedback_votes.user_vote) {
					case 0:
						$("#thbup_" + feedback_id).removeClass("text-success icon-fill")
						$("#thbdn_" + feedback_id).removeClass("text-error icon-fill")
						break;
					case 1:
						$("#thbup_" + feedback_id).addClass("text-success icon-fill")
						$("#thbdn_" + feedback_id).removeClass("text-error icon-fill")
						break;
					case -1:
						$("#thbup_" + feedback_id).removeClass("text-success icon-fill")
						$("#thbdn_" + feedback_id).addClass("text-error icon-fill")
						break;

					default:
						break;
				}
				$("#thbcn_" + feedback_id).text(data.result.feedback_votes.vote_count)
			}
		}).catch((error) => {
			console.error('Error:', error);
		});
}



function castCommentVote(feedback_comment_id, vote) {
	var data = {
		feedback_comment_id: feedback_comment_id,
		vote: vote,
	};

	fetch('/api/cast_feedback_comment_vote', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify(data),
	}).then((response) => response.json())
		.then((data) => {
			if (data.ok) {
				switch (data.result.feedback_comment_votes.user_vote) {
					case 0:
						$("#cthbup_" + feedback_comment_id).removeClass("text-success icon-fill")
						$("#cthbdn_" + feedback_comment_id).removeClass("text-error icon-fill")
						break;
					case 1:
						$("#cthbup_" + feedback_comment_id).addClass("text-success icon-fill")
						$("#cthbdn_" + feedback_comment_id).removeClass("text-error icon-fill")
						break;
					case -1:
						$("#cthbup_" + feedback_comment_id).removeClass("text-success icon-fill")
						$("#cthbdn_" + feedback_comment_id).addClass("text-error icon-fill")
						break;

					default:
						break;
				}
				$("#cthbcn_" + feedback_comment_id).text(data.result.feedback_comment_votes.vote_count)
			}
		}).catch((error) => {
			console.error('Error:', error);
		});
}


$(document).ready(() => {
	push_updateSubscription();
})