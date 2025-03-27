{extends file='../base.tpl'}

{block name=body}
    {include file='header.tpl'}

    <div class="container-fluid">
        <div class="row">

            {include file='sidebar.tpl'}

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Vezérlőpult</h1>
                </div>

                <h2>{$title}</h2>

                <hr>

                <div class="row">
                    <div class="col">
                        <h3>Felhasználók</h3>
                    </div>
                    <div class="col text-end">
                        <a href="?action=create&type=user" type="button" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-plus"></i> új hozzáadása
                        </a>
                    </div>
                </div>
                <div class="table-responsive small">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">E-mail cím</th>
                            <th scope="col">Jelszó</th>
                            <th scope="col">Státusz</th>
                            <th scope="col" class="text-end">Eszközök</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach $users as $user}
                            <tr>
                                <td>{$smarty.foreach.user.index + 1}</td>
                                <td>{$user.email}</td>
                                <td>{$user.password}</td>
                                <td>
                                    {if $user.is_active}
                                        <span class="badge bg-success">Aktív</span>
                                    {else}
                                        <span class="badge bg-danger">Inaktív</span>
                                    {/if}
                                </td>


                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" href="?action=edit&type=user&id={$user.id}">
                                        <i class="bi bi-pen"></i> Szerkesztés
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="?action=delete&type=user&id={$user.id}">
                                        <i class="bi bi-trash"></i> Törlés
                                    </a>
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <h3>Bejegyzések</h3>
                    </div>
                    <div class="col text-end">
                        <a href="?action=create&type=post" type="button" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-plus"></i> új hozzáadása
                        </a>
                    </div>
                </div>


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
                                        <a class="btn btn-sm btn-primary" href="?action=edit&type=post&id={$post.id}">
                                            <i class="bi bi-pen"></i> Szerkesztés
                                        </a>
                                        <a class="btn btn-sm btn-secondary" href="?action=delete&type=post&id={$post.id}">
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