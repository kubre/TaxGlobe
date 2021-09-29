<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Notification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \view()->share('notifications', $this->getNotifications());
        return $next($request);
    }

    private function getNotifications()
    {
        return auth()->user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(
                fn ($n) => (object) $this->{'format' . \class_basename($n->type)}($n)
            );
    }

    public function formatOrderStatusUpdated($notification)
    {
        return [
            'message' => "Status for order {$notification->data['product_title']} has been updated to \"{$notification->data['order_status']}\"",
            'time' => $notification->created_at->diffForHumans(null, false, true),
            'action' => route('shop.order.receipt', $notification->data['order_id']),
        ];
    }

    public function formatPostLiked($notification)
    {
        return [
            'message' => "Your {$notification->data['post_type']} has received some new likes",
            'time' => $notification->created_at->diffForHumans(null, false, true),
            'action' => route('post.show', $notification->data['post_slug']),
        ];
    }


    public function formatPostCommented($notification)
    {
        return [
            'message' => "{$notification->data['user_name']} commented on your {$notification->data['post_type']}",
            'time' => $notification->created_at->diffForHumans(null, false, true),
            'action' => route('post.show', $notification->data['post_slug']),
        ];
    }

    public function formatUserFollowed($notification)
    {
        return [
            'message' => "{$notification->data['user_name']} has started following you",
            'time' => $notification->created_at->diffForHumans(null, false, true),
            'action' => route('user.profile', $notification->data['user_id']),
        ];
    }
}
