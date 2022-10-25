<div class="min-w-full mx-auto fixed bottom-0">
	<div class="container max-w-3xl bg-base-200 mx-auto pb-3">
		<div class="flex">
			<a href="/" class="flex flex-col flex-grow py-3 px-4">
				<div class="rounded-full <?=NAVIGATION_PAGE == "home" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<ion-icon name="home<?=NAVIGATION_PAGE == "home" ? "" : "-outline"?>" class=""></ion-icon>
				</div>
				<span class="mx-auto text-xs font-bold mt-0.5">
					Home
				</span>
			</a>
			<a href="/news/" class="flex flex-col flex-grow py-3 px-4">
				<div class="rounded-full <?=NAVIGATION_PAGE == "news" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<ion-icon name="newspaper<?=NAVIGATION_PAGE == "news" ? "" : "-outline"?>"></ion-icon>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					News
				</span>
			</a>
			<a href="#" class="flex flex-col flex-grow py-3 px-4">
				<div class="rounded-full <?=NAVIGATION_PAGE == "schedule" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<ion-icon name="calendar<?=NAVIGATION_PAGE == "schedule" ? "" : "-outline"?>"></ion-icon>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					Orario
				</span>
			</a>
			<a href="#" class="flex flex-col flex-grow py-3 px-4">
				<div class="rounded-full <?=NAVIGATION_PAGE == "services" ? "bg-base-100" : "bg-transparent"?> mx-auto px-5 pt-1 align-middle">
					<ion-icon name="apps<?=NAVIGATION_PAGE == "services" ? "" : "-outline"?>"></ion-icon>
				</div>
				<span class="mx-auto text-xs font-semibold mt-0.5">
					Servizi
				</span>
			</a>
		</div>
	</div>
</div>