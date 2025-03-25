{extends file='../base.tpl'}

{block name=body}
    <div class="container">

        {include file='header.tpl'}

        <div class="row">
            <div class="col-12 col-lg-9">
                <h1>{$post.title}</h1>
                <p>
                    <small>
                        <i class="bi bi-person"></i> {$post.author}
                        <i class="bi bi-calendar"></i> {$post.created_at|date_format:"%Y-%m-%d %H:%M:%S"}
                        <i class="bi bi-calendar-plus"></i> {$post.updated_at|date_format:"%Y-%m-%d %H:%M:%S"}
                    </small>
                </p>
                {$post.content|nl2br}
            </div>
            <div class="col-12 col-lg-3">
                <h3>Legutóbbi bejegyzések</h3>
                <ul>
                    {foreach $posts as $post}
                        <li>
                            <a href="{$post.slug}">{$post.title}</a>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
{/block}