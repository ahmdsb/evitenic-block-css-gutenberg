const breakpoints = window.EvitenicBlockCSSData?.breakpoints?.length
	? window.EvitenicBlockCSSData.breakpoints
	: [
			{
				id: 'desktop',
				label: 'Desktop',
				type: 'base',
				value: null,
			},
	  ];

export default breakpoints;
