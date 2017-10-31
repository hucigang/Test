#coding=utf-8
# 演示用
P=				'python 下位机模拟'
from time import sleep
import json
import urllib2
import sys

# 传感器上传接口
URL 		= 'http://localhost:8092/07phppostcgq.php'
# 任务下载接口
URL_JOB		= 'http://localhost:8092/17phpjobdownload.php'
# 任务上报接口
URL_JOB_ACK	= 'http://localhost:8092/18phpjoback.php'

def GET_JSON_DATA(URL):
	'''GET方法获取数据
	'''
	res 	= urllib2.urlopen(URL)
	jsonStr = res.read()
	values	= json.loads(jsonStr)
	return values

def POST_ChaunGanQi(cliid, wendu, shidu, shuifa, qita):
	'''python 模拟终端上传传感器数据
	'''
	ChanGanQiArr	= {'id':cliid,'wendu':wendu,'shidu':shidu, 'shuifa':shuifa, 'qita':qita}
	POST_DATA		= 'jsonStr=' + json.dumps(ChanGanQiArr)
	req				= urllib2.Request(URL, POST_DATA.encode('utf-8'))
	res 			= urllib2.urlopen(req)
	print('上传> ID：%s\t湿度：%s\t水阀：%s' % (clientID, shidu, int(shuifa)))
	return res.read()


def Job_Download(cliid):
	'''下载任务队列
	'''
	global shuifa
	jobList = GET_JSON_DATA(URL_JOB + '?cid=' + cliid)
	for eachJob in jobList:
		jobData = json.loads(eachJob['jobJson'])
		jobid	= eachJob['jobid']
		print('任务ID：%d\t设置水阀：%d' % (jobid, int(jobData['shuifa'])))
		shuifa = jobData['shuifa']
		# 上报任务完成
		urllib2.urlopen(URL_JOB_ACK + '?jobid=' + str(jobid) + '&jobSta=DONE')
	pass


def main():
	global clientID, shidu, shuifa
	clientID, shidu, shuifa = sys.argv[1], int(sys.argv[2]), sys.argv[3]	# ID，湿度初始化，水阀
	while True:
		if shuifa == '1':
			shidu += 1
		else:
			shidu -= 1
		POST_ChaunGanQi(clientID, 25, shidu, shuifa, '')
		Job_Download(clientID)
		sleep(01)


if __name__ == '__main__':
	main()