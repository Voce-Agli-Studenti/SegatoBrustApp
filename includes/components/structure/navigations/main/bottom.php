<div class="min-w-full mx-auto fixed bottom-0 z-40">
	<div class="container max-w-3xl bg-base-200 mx-auto pb-2">
		<div class="flex">
			<a href="/" class="flex flex-col flex-grow py-3 px-3">
				<div
					class="rounded-full <?=NAVIGATION_PAGE == "home" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE == "home" ? "icon-fill" : ""?>">home</span>
				</div>
				<span class="mx-auto text-xs font-bold mt-0.5">
					Home
				</span>
			</a>
			<a href="/news/<?=USER_IS_TEACHER ? "personale" : "famiglia"?>/" class="flex flex-col flex-grow py-3 px-2">
				<div
					class="rounded-full <?=NAVIGATION_PAGE == "news" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<span
						class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE == "news" ? "icon-fill" : ""?>">newspaper</span>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					News
				</span>
			</a>
			<a href="/feedbacks/" class="flex flex-col flex-grow py-3 px-2">
				<div
					class="rounded-full <?=NAVIGATION_PAGE == "feedback" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<span
						class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE == "feedback" ? "icon-fill" : ""?>">campaign</span>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					FeedBack
				</span>
			</a>
			<a href="/services/" class="flex flex-col flex-grow py-3 px-2">
				<div
					class="rounded-full <?=NAVIGATION_PAGE == "services" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<span
						class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE == "services" ? "icon-fill" : ""?>">apps</span>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					Servizi
				</span>
			</a>
		</div>
	</div>
</div>