package feedback;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.Iterator;

import DataStructures.CustomComparator;
import DataStructures.DocReference;
import DataStructures.DocScoreTuple;
import DataStructures.InvertedIndexDic;
import DataStructures.Query;
import DataStructures.QueryTerm;
import Scoring.BM25L;
import Util.config;

public class RocchioFeedback {
	
	public static HashMap<Integer, Double> getFeedBackScore(HashMap<Integer, Double> rawScore, int itNum, Query query, int docTotal, 
			double avgDocLength, InvertedIndexDic dictionary, ArrayList<DocReference> docRefDic){
		HashMap<Integer, Double> currentScore = rawScore;
		ArrayList<Integer> nonrelevent = null;
		ArrayList<Integer> relevent = null;
		for(int n = 0; n < itNum; n++){
			nonrelevent = getNonrelevent(currentScore, docTotal);
			relevent = getRelevant(currentScore);
			double weight = 1;
			for(int i = 0; i < relevent.size(); i++){
				ArrayList<Integer> releventWords = docRefDic.get(relevent.get(i)).topWords;
				ArrayList<Integer> nonReleventWords = docRefDic.get(nonrelevent.get(i)).topWords;
				int judgeSize = (releventWords.size()<nonReleventWords.size())?releventWords.size():nonReleventWords.size();
				for(int j = 0; j < judgeSize; j++){
					QueryTerm tempTerm1 = new QueryTerm(releventWords.get(j));
					tempTerm1.termWeight = config.beta * weight;
					query.update(tempTerm1);
					QueryTerm tempTerm2 = new QueryTerm(nonReleventWords.get(j));
					tempTerm2.termWeight = config.gamma * weight;
					query.update(tempTerm2);
				}
				weight -= 1.0/config.JUDGE_NUM;
			}
			currentScore = BM25L.getRawScore(query, dictionary, docTotal, avgDocLength);
		}
		return currentScore;
	}

	private static ArrayList<Integer> getRelevant(HashMap<Integer, Double> currentScore) {
		Iterator<Integer> iter = currentScore.keySet().iterator();
		ArrayList<DocScoreTuple> topList = new ArrayList<DocScoreTuple>();
		while(iter.hasNext()) {
			Integer docID = (Integer)iter.next();
			double score = (double)currentScore.get(docID);
			DocScoreTuple current = new DocScoreTuple(docID, score);
			topList.add(current);
		}
		Collections.sort(topList, new CustomComparator());
		ArrayList<Integer> topDocs = new ArrayList<Integer>();
		for(int i = 0; i < config.JUDGE_NUM; i++){
			if(i >= topList.size())
				break;
			topDocs.add(topList.get(i).docID);
		}
		return topDocs;
	}

	private static ArrayList<Integer> getNonrelevent(HashMap<Integer, Double> currentScore, int docTotal) {
		ArrayList<Integer> result = new ArrayList<Integer>();
		int index = 0;
		while(index < config.JUDGE_NUM){
			int rand = (int)(Math.random() * docTotal);
			if(currentScore.get(rand) == null){
				result.add(rand);
				index++;
			}
		}
		return result;
	}
	
	
}
