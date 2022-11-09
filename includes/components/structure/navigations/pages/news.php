<div class="custom-tabs min-w-full mx-auto sticky top-0 z-40 bg-base-100">
	<div class="container max-w-3xl mx-auto">
		<div class="">
			<div class="flex">
				<a href="/news/famiglia/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_NEWS == "famiglia" ? "icon-filled" : "";?>">
							family_restroom
						</span>
					</div>
					<span class="mx-auto text-xs font-bold mt-0.5">
						Famiglia
					</span>
					<?php if (NAVIGATION_PAGE_NEWS == "famiglia"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
				<a href="/news/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_NEWS == "news" ? "icon-filled" : "";?>">
							newspaper
						</span>
					</div>
					<span class="mx-auto text-xs font-semibold mt-0.5">
						News
					</span>
					<?php if (NAVIGATION_PAGE_NEWS == "news"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
				<a href="/news/personale/" class="flex flex-col flex-grow pt-1 px-4">
					<div class="rounded-full mx-auto px-5 pt-1 align-middle">
						<span class="text-lg material-symbols-rounded <?=NAVIGATION_PAGE_NEWS == "personale" ? "icon-filled" : "";?>">
							school
						</span>
					</div>
					<span class="mx-auto text-xs font-semibold mt-0.5">
						Personale
					</span>
					<?php if (NAVIGATION_PAGE_NEWS == "personale"):?>
					<div class="bg-base-content pt-1 rounded-t mt-2 mx-auto" style="width: 30px;"></div>
					<?php endif?>
				</a>
			</div>
			<div class="divider p-0 m-0 max-h-0"></div>
		</div>

	</div>
</div>