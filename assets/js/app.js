function castVote(feedback_id, vote) {
	$.ajax({
		type: "POST",
		url: "/ajax/feedbacks/castvote/",
		data: {
			feedback_id: feedback_id,
			vote: vote,
		},
		success: function (response) {

			if (response.ok) {
				switch (response.result.feedback_votes.user_vote) {
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
				$("#thbcn_" + feedback_id).text(response.result.feedback_votes.vote_count)
			}
		},
	})
}


$(document).ready(() => {
	push_updateSubscription();
})