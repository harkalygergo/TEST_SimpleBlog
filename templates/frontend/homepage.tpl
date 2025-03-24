{extends file='../base.tpl'}

{block name=body}
    {foreach $posts as $post}
        <article>
            <h2>{$post.title}</h2>
            <p>{$post.content}</p>
            <p>{$post.author}</p>
        </article>
    {/foreach}
{/block}