<script>
		const pathList = location.pathname.split("/");
		const postId = pathList[pathList.length - 1];
		const url = `http://localhost:8080/posts/${postId}/edit`;

		window.addEventListener('DOMContentLoaded', () => {
			const form = document.querySelector("form");
			form.action = url;
		})

		const getPostEditPage = async () => {
			window.location.replace(url);
		}

</script>
<label for="title" class="font-bold">title:</label>
	<h2 id="title">%title%</h2>
	<label for="body" class="font-bold">body:</label>
	<p id="body">%body%</p>
	<div class="font-bold">tags</div>
	<div>%tags%</div>
	<div class="font-bold">images</div>
	<div class="flex">%images%</div>
	<div class="font-bold">user</div>
	<div class="flex items-center">
		<img class="inline-block h-8 w-8 rounded-full ring-2 ring-white mr-4"
				src="%user-avatar%"
				alt="user avatar">
		<p>%user-name%</p>
	</div>
	<button onclick="getPostEditPage()">編集</button>
	<form method="post" action="">
		<input hidden id="_method" name="_method" value="DELETE"/>
		<button type="submit">削除</button>
	</form>
