{extends file='../base.tpl'}

{block name=body}
    {foreach $posts as $post}
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <article>
                        <h2>{$post.title}</h2>
                        <p>{$post.content}</p>
                        <p>{$post.author}</p>
                        <a class="btn btn-primary" href="{$post.slug}">elolvasom</a>
                        <hr>
                    </article>
                </div>
            </div>
        </div>
    {/foreach}
{/block}