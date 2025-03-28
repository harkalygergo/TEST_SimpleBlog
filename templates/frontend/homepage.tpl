{extends file='../base.tpl'}

{block name=body}
    <div class="container">

        {include file='header.tpl'}

        <div class="row">
        {foreach $posts as $post}
                <div class="col-12 col-md-6">
                    <article class="p-4 mb-4 bg-light rounded">
                        <h2>{$post.title}</h2>
                        <p>
                            <small>
                                <i class="bi bi-person"></i> {$post.author}
                                <i class="bi bi-calendar"></i> {$post.created_at|date_format:"%Y-%m-%d %H:%M:%S"}
                                <i class="bi bi-calendar-plus"></i> {$post.updated_at|date_format:"%Y-%m-%d %H:%M:%S"}
                            </small>
                        </p>
                        <p>{$post.content|nl2br}</p>
                        <p>
                            <a class="btn btn-primary" href="{$post.slug}">elolvasom &raquo;</a>
                        </p>
                    </article>
                </div>
        {/foreach}
        </div>
    </div>
{/block}