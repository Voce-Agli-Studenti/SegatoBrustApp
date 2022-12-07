<div class="custom-tabs min-w-full mx-auto sticky top-0 z-40 bg-base-100">
	<div class="container max-w-3xl mx-auto">
		<div class="">
			<div class="flex">
				<a href="/feedbacks/app/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_FEEDBACK == "app" ? "icon-filled" : "";?>">
						construction
						</span>
					</div>
					<span class="mx-auto text-xs font-bold mt-0.5">
						App 
					</span>
					<?php if (NAVIGATION_PAGE_FEEDBACK == "app"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
				<a href="/feedbacks/school/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_FEEDBACK == "school" ? "icon-filled" : "";?>">
							warning
						</span>
					</div>
					<span class="mx-auto text-xs font-semibold mt-0.5">
						Scuola
					</span>
					<?php if (NAVIGATION_PAGE_FEEDBACK == "school"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
				<a href="/feedbacks/ideas/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_FEEDBACK == "ideas" ? "icon-filled" : "";?>">
						tips_and_updates
						</span>
					</div>
					<span class="mx-auto text-xs font-semibold mt-0.5">
						Idee
					</span>
					<?php if (NAVIGATION_PAGE_FEEDBACK == "ideas"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
			</div>
			<div class="divider p-0 m-0 max-h-0"></div>
		</div>

	</div>
</div>