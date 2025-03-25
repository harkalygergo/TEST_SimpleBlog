{extends file='../base.tpl'}

{block name=body}
    {include file='backend/header.tpl'}

    <div class="container-fluid">
        <div class="row">

            {include file='backend/sidebar.tpl'}

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Vezérlőpult</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-plus"></i> új hozzáadása
                            </button>
                        </div>
                    </div>
                </div>

                <h2>{$title}</h2>
                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cím</th>
                                <th scope="col">Szerző</th>
                                <th scope="col">Készítve</th>
                                <th scope="col">Módosítva</th>
                                <th scope="col" class="text-end">Eszközök</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $posts as $post}
                                <tr>
                                    <td>{$smarty.foreach.posts.index + 1}</td>
                                    <td>{$post.title}</td>
                                    <td>{$post.author}</td>
                                    <td>{$post.created_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td>{$post.updated_at|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-primary" href="?action=edit&id={$post.id}">
                                            <i class="bi bi-pen"></i> Szerkesztés
                                        </a>
                                        <a class="btn btn-sm btn-secondary" href="?action=delete&id={$post.id}">
                                            <i class="bi bi-trash"></i> Törlés
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
{/block}