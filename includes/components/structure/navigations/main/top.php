<?php if (USER_IS_LOGGED):?>
<div class="container max-w-3xl mx-auto pt-6 pb-4 px-6">
	<div class="flex justify-between align-middle">
		<h2 class="text-lg font-semibold py-0 my-0"><?=htmlspecialchars(PAGE_TITLE)?></h2>
		<div class="dropdown dropdown-end">
			<div class="w-8 cursor-pointer" tabindex="0">
				<img src="<?=USER['avatar_url']?>" alt="<?=htmlspecialchars(USER['name'])?>" class="rounded-full" />
			</div>
			<ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
				<li>
					<a href="/settings/" class="">
						<i class="bi bi-gear-fill me-1"></i>
						Impostazioni
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php else:?>

<div class="container max-w-3xl mx-auto pt-6 pb-4 px-6">
	<div class="flex justify-end">
		<a href="/login/" class="bg-transparent my-auto text-xl">
			Accedi
		</a>
	</div>
</div>
<?php endif;?>