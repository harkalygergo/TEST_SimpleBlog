{extends file='../base.tpl'}

{block name=body}
<!-- include header.tpl -->
{include file='backend/header.tpl'}

<div class="container-fluid">
    <div class="row">

        {include file='backend/sidebar.tpl'}

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{$title}</h1>
            </div>

            <form action="?action=update&id={$post.id}" method="post">
                <input type="hidden" name="id" value="{$post.id}">
                <div class="mb-3">
                    <label for="title" class="form-label">Cím</label>
                    <input type="text" class="form-control" id="title" name="title" value="{$post.title}">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Szerző</label>
                    <input type="text" class="form-control" id="author" name="author" value="{$post.author}">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Tartalom</label>
                    <textarea class="form-control" id="content" name="content" rows="10">{$post.content}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Mentés</button>
            </form>
        </main>
    </div>
</div>
{/block}