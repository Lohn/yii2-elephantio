<?php
namespace lohn\redisemitter;
use yii\base\Component;
use SocketIO\Emitter;

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
		$db = $this->db;
		$redis = new \Redis();
		$redis->connect($server, $port);
		$redis->select($db);
		$this->_client = new Emitter($redis);
	}
	public function emit($event, $params = [], $namespace = null)
	{
		return $this->_client->emitEvent($event, $params);
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
