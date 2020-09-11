

public class Process
    {
        public boolean IsStateChanged;
        public int Pid;
        public long CpuTimeNeeded;
        public QueueHandler ParentQueue;
        public long TimeInQueue;

        public Process(int pid, long cpuTimeNeeded)
        {
            Pid = pid;
            ParentQueue = null;
            CpuTimeNeeded = cpuTimeNeeded;
            IsStateChanged = false;
            TimeInQueue = 0;
        } 


        void setParentQueue(QueueHandler queueHandler)
        {
            ParentQueue = queueHandler;
        }

        boolean IsFinished()
        {
            return (CpuTimeNeeded == 0);
        }

        void executeProcess(long time)
        {      	
            IsStateChanged = false;

            CpuTimeNeeded = CpuTimeNeeded - time;
            
            // this line ensures that cpuTimeNeeded never gets set below 0
            CpuTimeNeeded = CpuTimeNeeded > 0? CpuTimeNeeded : 0;    
        }
    }