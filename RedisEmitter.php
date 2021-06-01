<?php
namespace lohn\yii2-socketio-redis-emitter;
use yii\base\Component;

class RedisEmitter extends Component
{
	public $server = '127.0.0.1';
	
	public $port = 6379;
	
	public $db = 0;

	public $options = [];

	private $_client;
	
	public function init()
	{
		parent::init();
		$server = $this->server;
		$port = $this->port;
		$port = $this->db;
		$redis = new \Redis();
		$redis->connect($server, $host);
		$redis->select($db);
		$this->_client =new SocketIO\Emitter($redis);
	}
	public function emit($event, $params = [], $namespace = null)
	{
		return $this->_client->emit($event, $params);
	}
	public function read()
	{
		return;
	}
	public function close()
	{
		return;
	}
}
